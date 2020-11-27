import {Component, OnInit} from '@angular/core';
import {ClassesService} from "../classes.service";
import {ClassesModal} from "../classes-modal";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  classes: ClassesModal[] = [];

  constructor(public classesService: ClassesService) { }

  ngOnInit(): void {
     this.classesService.getAllClasses().subscribe((res: ClassesModal[]) => {
      this.classes = res;
    });
  }

}
