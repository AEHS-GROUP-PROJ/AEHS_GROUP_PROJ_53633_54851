CREATE TABLE `users` (
  `id` integer PRIMARY KEY,
  `user_name` varchar(255),
  `full_name` varchar(255),
  `email` varchar(255),
  `address` varchar(255),
  `phone` varchar(255),
  `is_student` bool,
  `is_lecturer` bool,
  `is_admin` bool,
  `password_hash` varchar(255)
);

CREATE TABLE `sessions` (
  `token` varchar(255) PRIMARY KEY,
  `user_id` integer,
  `logged_in` timestamp,
  `logged_out` timestamp,
  `host` varchar(255),
  `agent` varchar(255)
);

CREATE TABLE `courses` (
  `id` integer PRIMARY KEY,
  `title` varchar(255),
  `start_date` date,
  `end_date` date,
  `places` integer
);

CREATE TABLE `lectures` (
  `id` integer PRIMARY KEY,
  `course_id` integer,
  `lecturer_id` integer,
  `classroom_id` integer,
  `title` varchar(255),
  `start_time` datetime,
  `end_time` datetime
);

CREATE TABLE `classrooms` (
  `id` integer PRIMARY KEY,
  `room_no` integer,
  `title` varchar(255)
);

CREATE TABLE `attendance` (
  `lecture_id` integer,
  `student_id` integer
);

CREATE TABLE `enrollments` (
  `student_id` integer,
  `course_id` integer,
  `applied_at` datetime,
  `approved` bool,
  `onboard_date` date,
  `offboard_date` date
);

CREATE TABLE `assignments` (
  `id` integer PRIMARY KEY,
  `course_id` integer,
  `title` varchar(255),
  `starts_at` datetime,
  `ends_at` datetime
);

CREATE TABLE `assignment_submissions` (
  `assignment_id` integer,
  `student_id` integer,
  `submitted_at` datetime,
  `graded_at` datetime,
  `grade` integer
);

ALTER TABLE `sessions` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `enrollments` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

ALTER TABLE `enrollments` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `assignments` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `lectures` ADD FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

ALTER TABLE `lectures` ADD FOREIGN KEY (`lecturer_id`) REFERENCES `users` (`id`);

ALTER TABLE `lectures` ADD FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`);

ALTER TABLE `assignment_submissions` ADD FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`);

ALTER TABLE `assignment_submissions` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

ALTER TABLE `attendance` ADD FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`id`);

ALTER TABLE `attendance` ADD FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);
