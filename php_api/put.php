<?php
/**
 * HTTP PUT - Update an existing record in the Employee table
 * @param $employee
 * @return mixed
 */
function updateEmployee($eid)
{
    //TODO - implementation
    $employee = new Employee($conn, "employee");

    $data = json_decode(file_get_contents("php://input"));

    // Set the id of employee to be edited
    $employee->eid = $data->eid;

    // Set values
    $employee->first_name = $data->first_name;
    $employee->last_name = $data->last_name;
    $employee->email = $data->email;
    $employee->position = $data->position;
    $employee->company = $data->company;
    $employee->country = $data->country;

    if($employee->put($employee, $eid)){
        http_response_code(200);

        echo json_encode(array("message" => "Employee updated"));
    }

    // Handle failure
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Unable to update employee"));
    }
}