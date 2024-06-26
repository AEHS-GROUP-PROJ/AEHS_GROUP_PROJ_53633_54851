# AEHS Group Project (Spring 2024)

Last revision: 2024-05-18

### Participants:

- **Mikhail Melikhov** ``53633``
- **Nika Gurchiani** ``54851``

### Project Topic

**Student Information System** - a web-application allowing managing student information in an educational institution.

### Intended functionality

**User management:** The SIS provides administrators with tools to create, modify, and delete user accounts. Each account can be assigned one or more roles, such as student, lecturer, or administrator.

**Course management:** Administrators and lecturers can create, edit, and manage course offerings within the system. They can specify course details such as title, description and enrolment capacity.

**Enrolment management:** Administrators and lecturers can manage enrolment by approving or rejecting enrolment requests, adjusting course rosters, and generating enrolment reports.

**Lecture management:** allows administrators and lecturers to efficiently handle various aspects of organizing and conducting lectures within the student information system.

**Assignment management:** streamlines the process of creating, distributing, and grading assignments for courses within the student information system.

**Gradebook:** Teachers have access to a gradebook feature where they can record and manage student grades for their courses. Students can view their grades through their accounts.

### Technology stack

| Duty | Technology |
| --- | --- |
| **Backend** | PHP |
| **Frontend** | Vanilla JavaScript |
| **Database** | MySQL |

### Repository structure

| Path | Description |
| --- | --- |
| ``/README.md`` | This file |
| ``/db`` | Database related documentation |
| ``/src`` | Codebase |
| ``/src/actions`` | Business logic related to user's actions |
| ``/src/lib`` | Misc. helping functions |
| ``/src/routes`` | Routes for app's UI layouts |
| ``/src/static`` | Statically served content |
| ``/src/index.php`` | Application's main request handler |
| ``/tests`` | Unit tests |

### Implemented functionality

- Password-based authorization
- User management
- User role separation (student, lecturer, administrator)
- Course management
- Ability to apply to courses and withdraw
- Enrolment management (administration acceptance, dropping out)
- Managing course capacity (placements)
- Managing classrooms
- Scheduling lectures (including schedule integrity control)
- Tracking lecture attendance
- Announcement feed
- Assignment management
- Assignment grading

### Setup instructions

1. Make sure your environment has PHP and MySQL set up and running.
2. Import ``/db/schema.sql`` to set up the database schema.
3. (Optionally) import ``/db/mockup_data.sql`` to populate DB with mockup data.
4. Update ``/src/lib/database.php`` file with your system's database credentials.
5. Serve the ``/src`` directory with a web server of your choice (e.g. Apache).
