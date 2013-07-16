Select username, email1, start_date, salary, company_name from comp, emp, user where cid=cidfk and eid=eidfk and permission_level='admin' and is_permission_level_active=1;
