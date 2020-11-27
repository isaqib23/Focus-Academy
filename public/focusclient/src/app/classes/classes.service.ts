import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from "@angular/common/http";
import {Observable, throwError} from 'rxjs';
import { catchError } from 'rxjs/operators';
import { ClassesModal } from "./classes-modal";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class ClassesService {

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  };

  constructor(private httpClient: HttpClient) { }

  create(data: ClassesModal): Observable<ClassesModal> {
    return this.httpClient.post<ClassesModal>(environment.apiBaseUrl + 'classes/create', JSON.stringify(data), this.httpOptions)
      .pipe(
        catchError(error => {
          return throwError(this.getServerErrorMessage(error));
        })
      );
  }

  getAllClasses(): Observable<ClassesModal[]> {
    return this.httpClient.get<ClassesModal[]>(environment.apiBaseUrl + 'classes/all', this.httpOptions)
      .pipe(
        catchError(error => {
          return throwError(this.getServerErrorMessage(error));
        })
      );
  }

  getClassById(data: number): Observable<ClassesModal> {
    return this.httpClient.get<ClassesModal>(environment.apiBaseUrl + 'classes/getClassById/'+data, this.httpOptions)
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
