import { Component, OnInit } from '@angular/core';
import {StudentsService} from "../students.service";
import {Student} from "../student";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  students: Student[] = [];

  constructor(public studentsService: StudentsService) { }

  ngOnInit(): void {
    this.studentsService.getAllStudents().subscribe((res: Student[]) => {
      this.students = res;
    });
  }

}
