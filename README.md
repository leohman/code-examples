##code-examples
### Task 1
Explain what this code in [admin.php](https://github.com/madsec/code-examples/admin.php) does, line by line, in plain, concise english.  Identify as many bugs as you can and why they are bugs.
>Context: A page called login.php asks for a username and password.  If they are correct, it redirects them to admin.php below.

### Task 2
Improve this database (adjust fields, data format, tables, order, etc).
>Format answer the same form as the sample data data.

```bash
Employees
id, username, email1, email2, password, company_name, company_phone, company_address, job_title, salary, permission_level, is_permission_level_active, start_date
37, JohnSmith, jsmith@acme.com, johnsmith@acme.com, 764efa883dda1e11db47671c4a3bbd9e, ACME Inc, 555-2323, 123 Acme Way, Director, $100,000, admin, true, 2012-02-23
39, JaneSmith, jsmith1@acme.com, NULL, 153c2c618d157c4a3ba08e23a06b70d7, ACME INC, 555-2323, 123 ACME WAY, VP, $120,000, user, true, 99-03-19
40, ChrisSmith, csmith1@example.com, NULL, 34921ae7e3079e44e0ee2f96d8ee6e87, Example Dot Com, 555-1234, 456 Example Lane, Manager, $60,000, user, false, 2010-8-4
42, KateSmith, ksmith1@example.com, NULL, dbe39d9d56f98d5f9cb22df15b285791, Example Dot Com, 555-1234, 456 Example Lane, Sr Manager, $80,000, admin, false, 2004-12-24
```

### Task 3
After improving the database, write a raw sql statement that gets the username, first email, start_date, salary, and company_name for all active admins from your new database format.
