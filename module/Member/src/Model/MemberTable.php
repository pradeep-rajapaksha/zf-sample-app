<?php 
namespace Member\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class MemberTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getMember($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveMember(Member $member)
    {
        $data = [
            'f_name' => $member->f_name,
            'l_name' => $member->l_name,
            'address'  => $member->address,
        ];

        $id = (int) $member->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getMember($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update member with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteMember($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}