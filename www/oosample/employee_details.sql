Select em.*, ti.*, sal.*, dept.*
FROM employees as em 
	INNER JOIN titles as ti 
		ON em.emp_no = ti.emp_no 
	INNER JOIN salaries as sal 
		ON ti.emp_no = sal.emp_no
	INNER JOIN dept_emp as de
		ON sal.emp_no = de.emp_no
	INNER JOIN departments as dept
		ON de.dept_no = dept.dept_no
WHERE em.emp_no = 10009; 