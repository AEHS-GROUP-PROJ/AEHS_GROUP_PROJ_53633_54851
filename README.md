# AEHS Group Project (Spring 2024)

Last revision: 2024-04-14

### Participants:

- **Mikhail Melikhov** ``53633``
- **Nika Gurchiani** ``54851``
- **Eljan Rustamov** ``54856``
- **Sai Rentapalli** ``55986``

### Project Topic

**Student Information System** - a web-application allowing managing student information in an educational institution.

### Intended functionality

**User management:** The SIS provides administrators with tools to create, modify, and delete user accounts. Each account can be assigned one or more roles, such as student, lecturer, or administrator.

**Course management:** Administrators and lecturers can create, edit, and manage course offerings within the system. They can specify course details such as title, description and enrolment capacity.

**enrolment management:** Administrators and lecturers can manage enrolment by approving or rejecting enrolment requests, adjusting course rosters, and generating enrolment reports.

**Gradebook:** Teachers have access to a gradebook feature where they can record and manage student grades for their courses. Students can view their grades through their accounts.

### Technology stack

| Duty | Technology |
| --- | --- |
| **Backend** | PHP |
| **Frontend** | HTML UI with JavaScript validations |
| **Database** | MySQL |

### Repository structure

| Path | Description |
| --- | --- |
| ``/README.md`` | This file |
| ``index.php`` | App's entry point |
| ``/db`` | Database related documentation |
| ``/src`` | Codebase |
| ``/src/actions`` | Business logic related to user's actions |
| ``/src/lib`` | Misc. helping functions |
| ``/src/routes`` | Routes for app's UI layouts |
| ``/src/static`` | Statically served content |
| ``/tests`` | Unit tests |

### Currently implemented functionality

- Password-based authorization
- User role management (student, lecturer, administrator)
- Basic user management
- Course management
- Ability to apply to courses and withdraw
- Enrolment management (administration acceptance, dropping out)
- Managing course capacity (placements)
- Managing classrooms

### Setup instructions

1. Make sure your environment has PHP and MysqL set up and running.
2. Import ``/db/schema.sql`` to set up the database schema.
3. Update ``/src/lib/database.php`` file with your system's database credentials.
3. Serve the ``/src`` directory with a web server of your choice (e.g. Apache).