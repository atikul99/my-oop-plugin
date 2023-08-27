<?php


class Activate{

	public static function activate() {

		global $wpdb;

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$student_table = $wpdb->prefix . 'student_list';

		$teacher_table = $wpdb->prefix . 'teacher_list';

	    if ($wpdb->get_var("SHOW TABLES LIKE '$student_table'") != $student_table) {
	        
			$student = "CREATE TABLE $student_table (
				id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(255) NOT NULL,
				class VARCHAR(255) NOT NULL,
				age INTEGER(3),
				PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

	        dbDelta($student);
	    }

		if ($wpdb->get_var("SHOW TABLES LIKE '$teacher_table'") != $teacher_table) {

			$teacher = "CREATE TABLE $teacher_table (
				id INT NOT NULL AUTO_INCREMENT,
				tname VARCHAR(255) NOT NULL,
				department VARCHAR(255) NOT NULL,
				tage INTEGER(3),
				PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

			dbDelta($teacher);

		}
	}
}