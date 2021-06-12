<?php
/**
 * HTTP DELETE - Delete one record or all records from the Employee table
 * @param $employee
 * @return mixed
 */
function deleteEmployee($employee)
{
    //TODO - implementation
    $employee = new Employee($conn, "employee");

    $data = json_decode(file_get_contents("php://input"));

    $employee->eid = $data->eid;

    // Delete the employee

    if ($employee->delete()){
        http_response_code(200);
        echo json_encode(array("message" => "Employee Deleted"));
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to delete employee"));
    }
}