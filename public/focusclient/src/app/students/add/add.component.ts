import { Component, OnInit } from '@angular/core';
import { StudentsService } from "../students.service";
import { ClassesService } from "../../classes/classes.service";
import { FormBuilder, FormGroup, Validators  } from '@angular/forms';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';
import {ClassesModal} from "../../classes/classes-modal";
import {NgbDateStruct, NgbCalendar, NgbDate} from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-add',
  templateUrl: './add.component.html',
  styleUrls: ['./add.component.css']
})
export class AddComponent implements OnInit {
  studentForm: FormGroup;
  submitted = false;
  student_id: number;
  classes: ClassesModal[] = [];
  today = this.calendar.getToday();

  constructor(
    public formBuilder: FormBuilder,
    private router: Router,
    public studentsService: StudentsService,
    public classesService: ClassesService,
    private actRoute: ActivatedRoute,
    private calendar: NgbCalendar
  ) {
    this.classes = [];
    this.student_id = this.actRoute.snapshot.params.id;
  }

  ngOnInit(): void {
    this.classesService.getAllClasses().subscribe(res => {
      this.classes = res;
    });
    if(this.student_id !== undefined){
      this.studentsService.getStudentById(this.student_id).subscribe(res => {
        this.studentForm.get("id").setValue(res.id);
        this.studentForm.get("first_name").setValue(res.first_name);
        this.studentForm.get("last_name").setValue(res.last_name);
        this.studentForm.get("class_id").setValue(res.class_id);
        this.studentForm.get("date_of_birth").setValue(res.formatted_dob);
      });
    }
    this.studentForm = this.formBuilder.group({
      id: [''],
      first_name: ['', Validators.required],
      last_name: ['', Validators.required],
      class_id: ['', Validators.required],
      date_of_birth: ['', Validators.required]
    });
  }

  // convenience getter for easy access to form fields
  get formControl() { return this.studentForm.controls; }

  submitForm(): void {
    this.submitted = true;

    // stop here if form is invalid
    if (this.studentForm.invalid) {
      return;
    }

    this.studentsService.create(this.studentForm.value).subscribe(res => {
      this.router.navigateByUrl('/students');
    });
  }
}
