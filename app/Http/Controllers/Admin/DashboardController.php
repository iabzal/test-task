<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response|ResponseFactory
     */
    public function __invoke(Request $request): Response|ResponseFactory
    {
        $companies = Client::count();
        $departments = Department::count();
        $employees = Employee::count();
        $tests = Test::count();

        return inertia('Admin/Dashboard/Index', [
            'companies' => $companies,
            'departments' => $departments,
            'employees' => $employees,
            'tests' => $tests,
        ]);
    }
}
