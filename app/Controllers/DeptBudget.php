<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;


class DeptBudget extends BaseController
{
    public function Edit_budget()
    {
        // Show value of old department data in the table when clicked by the edit button
        $departmentModel = new DepartmentModel();
        $dept_id = $this->request->getPost('id');
        $data['budget'] = $departmentModel->find($dept_id);
        return $this->response->setJSON($data);
    }
    public function Update_budget()
    {
        // update department modal form
        $department = new DepartmentModel();
        $department_update_id = $this->request->getPost('department_id');
        $validation = \Config\Services::validation();
        // insert the value into the database variable
        $data = [

            'department_budget' => $this->request->getPost('allocated_budget'),
            'department_budget_remaining' => $this->request->getPost('budget_remaining'),
        ];
        // validation kung tama ang data na ininput
        $validation->setRules([

            'allocated_budget' => 'required',
        ]);
        // kung hindi mag popop up ang error message
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'message' => implode("<br>", $validation->getErrors())
            ]);
        } else {

            // insert the data into the database and update it
            $department->update($department_update_id, $data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully Added',
            ]);
        }
    }
}
