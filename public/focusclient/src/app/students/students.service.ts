import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from "@angular/common/http";
import {Observable, throwError} from 'rxjs';
import { catchError } from 'rxjs/operators';
import { Student } from "./student";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class StudentsService {

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  };

  constructor(private httpClient: HttpClient) { }

  create(data: Student): Observable<Student> {
    return this.httpClient.post<Student>(environment.apiBaseUrl + 'students/create', JSON.stringify(data), this.httpOptions)
      .pipe(
        catchError(error => {
          return throwError(this.getServerErrorMessage(error));
        })
      );
  }

  getAllStudents(): Observable<Student[]> {
    return this.httpClient.get<Student[]>(environment.apiBaseUrl + 'students/all', this.httpOptions)
      .pipe(
        catchError(error => {
          return throwError(this.getServerErrorMessage(error));
        })
      );
  }

  getStudentById(data: number): Observable<Student> {
    return this.httpClient.get<Student>(environment.apiBaseUrl + 'students/getStudentById/'+data, this.httpOptions)
      .pipe(
        catchError(error => {
          return throwError(this.getServerErrorMessage(error));
        })
      );
  }

  private getServerErrorMessage(error: HttpErrorResponse): string {
    switch (error.status) {
      case 404: {
        return `Not Found: ${error.message}`;
      }
      case 403: {
        return `Access Denied: ${error.message}`;
      }
      case 500: {
        return `Internal Server Error: ${error.message}`;
      }
      default: {
        return `Unknown Server Error: ${error.message}`;
      }

    }
  }
}
