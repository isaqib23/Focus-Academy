import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from "./home/home.component";
import { AddComponent } from "./add/add.component";

const routes: Routes = [
  { path: 'students', component: HomeComponent },
  { path: 'students/add', component: AddComponent },
  { path: 'students/edit/:id', component: AddComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class StudentsRoutingModule { }
