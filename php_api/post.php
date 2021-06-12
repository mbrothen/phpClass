<?php
/**
 * HTTP POST - add one record to the Employee table
 * @param $employee
 * @return mixed
 */
function addEmployee($employee)
{
    //TODO - implementation
    $employee = new Employee($conn, "employee");

    $data = json_decode(file_get_contents("php://input"));

    if(
        !empty($data->first_name) &&
        !empty($data->last_name) &&
        !empty($data->email) &&
        !empty($data->postion) &&
        !empty($data->company) &&
        !empty($data->country)
    ) {
        // Set employee values
        $employee->first_name = $data->first_name;
        $employee->last_name = $data->last_name;
        $employee->email = $data->email;
        $employee->position = $data->position;
        $employee->company = $data->company;
        $employee->country = $data->country;

        if($employee->post()){
            // Set response code 201 created
            http_response_code(201);

            echo json_encode(array("message" => "Employee created"));
        }

        else {
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to create employee"));
        }
    }

    else {
        // Set the response for bad request
        http_response_code(400);

        // show result
        echo json_encode(array("message" => "Unable to create employee.  Incomplete data"));
    }
}