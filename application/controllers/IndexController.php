<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->title = 'Homepage';
        
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $sql = $db->select()
                  ->from('employees', array('employee_count' => 'COUNT(employees.emp_no)', 'gender', 'age' => 'year(now()) - year(employees.birth_date)'))
                  ->joinLeft('dept_emp', 'dept_emp.emp_no = employees.emp_no', array())
                  ->joinLeft('departments', 'dept_emp.dept_no = departments.dept_no', array('dept_name'))
                  ->group('departments.dept_no')
                  ->group('employees.gender')
                  ->group('year(now()) - year(employees.birth_date)')
                  ->order('departments.dept_name')
                  ->order('age')
                  ->order('gender');
        $this->view->depts = $db->fetchAll($sql);
        // action body
    }


}

