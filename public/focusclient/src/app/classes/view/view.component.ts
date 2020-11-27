import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ClassesService } from "../classes.service";
import {ClassesModal} from "../classes-modal";

@Component({
  selector: 'app-view',
  templateUrl: './view.component.html',
  styleUrls: ['./view.component.css']
})
export class ViewComponent implements OnInit {
  class_id: number;
  class: ClassesModal = {};

  constructor(
    private actRoute: ActivatedRoute,
    public classesService: ClassesService
    ) {
    this.class_id = this.actRoute.snapshot.params.id;
  }

  ngOnInit(): void {
    this.classesService.getClassById(this.class_id).subscribe(res => {
      this.class = res;
    });
  }

}
