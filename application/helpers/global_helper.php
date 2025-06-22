<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    if(!function_exists('role_list'))
    {
        function role_list() {
            $status = array(
                    "admin" => "Admin",
                    "dealer" => "Dealer",
                    "customer" => "Customer"
                );

            return $status;
        }
    }

    if(!function_exists('colors_list'))
    {
        function colors_list() {
            $status = array(
                "#ffffff" => "White",
                "#00a4ff" => "Blue",
                "#f10a0a" => "Red",
                "#aab5bb" => "Grey",
                "#000000" => "Black",
                "#682c18" => "Brown"
            );

            return $status;
        }
    }
    if(!function_exists('category_list'))
    {
        function category_list() {
            $status = array(
                    1 => "Popular",
                    2 => "Offers",
                    3 => "Brand New",
                    4 => "Electric"
                );

            return $status;
        }
    }
    if(!function_exists('duration_list'))
    {
        function duration_list() {
            $status = array(
                    3 => "3 Month",
                    6 => "6 Months",
                    12 => "12 Months",
                    24 => "24 Months",
                    48 => "48 Months"
                );

            return $status;
        }
    }
    if(!function_exists('package_status'))
    {
        function package_status() {
            $status = array(
                    "false" => "Select",
                    "true" => "Best Server"
                );

            return $status;
        }
    }
    if(!function_exists('booking_approvelist'))
    {
        function booking_approvelist() {
            $status = array(
                    "1" => "Pending",
                    "2" => "Pending Approval",
                    "3" => "Approve",
                    "4" => "Reject"
                );

            return $status;
        }
    }

?>