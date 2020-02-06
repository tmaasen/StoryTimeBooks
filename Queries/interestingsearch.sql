with EmployeesWhoReportToManager6 as 
(
select * 
from employee 
where ManagerID = 6
)
select * from EmployeesWhoReportToManager6