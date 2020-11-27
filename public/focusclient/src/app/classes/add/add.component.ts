import { Component, OnInit } from '@angular/core';
import { ClassesService } from "../classes.service";
import { FormBuilder, FormGroup, Validators  } from '@angular/forms';
import { Router } from '@angular/router';
import { classCodeValidation } from "./classCodeValidation";
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-add',
  templateUrl: './add.component.html',
  styleUrls: ['./add.component.css']
})
export class AddComponent implements OnInit {
  classForm: FormGroup;
  submitted = false;
  class_id: number;

  constructor(
    public formBuilder: FormBuilder,
    private router: Router,
    public classesService: ClassesService,
    private actRoute: ActivatedRoute
  ) {
    this.class_id = this.actRoute.snapshot.params.id;
  }

  ngOnInit(): void {
    if(this.class_id !== undefined){
      this.classesService.getClassById(this.class_id).subscribe(res => {
        this.classForm.get("name").setValue(res.name);
        this.classForm.get("description").setValue(res.description);
        this.classForm.get("code").setValue(res.code);
        this.classForm.get("max_students").setValue(res.max_students);
        this.classForm.get("id").setValue(res.id);
      });
    }
    this.classForm = this.formBuilder.group({
      id: [''],
      name: ['', Validators.required],
      description: [''],
      code: ['', [Validators.required, classCodeValidation.cannotContainSpace]],
      max_students: ['', [Validators.required, Validators.max(10), Validators.min(1)]],
    });
  }

  // convenience getter for easy access to form fields
  get formControl() { return this.classForm.controls; }

  submitForm(): void {
    this.submitted = true;

    // stop here if form is invalid
    if (this.classForm.invalid) {
      return;
    }

    this.classesService.create(this.classForm.value).subscribe(res => {
      this.router.navigateByUrl('/');
    });
  }

}
