<?php


class Deactivate{

	public static function deactivate() {

		global $wpdb;

		$student_table = $wpdb->prefix . 'student_list';

		$teacher_table = $wpdb->prefix . 'teacher_list';

		$wpdb->query( "DROP TABLE IF EXISTS $student_table, $teacher_table" );
	
	}
}