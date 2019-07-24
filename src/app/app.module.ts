import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import {FormsModule} from '@angular/forms';
import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';

import {NgxDatatableModule} from '@swimlane/ngx-datatable';
import {HttpClientModule} from '@angular/common/http';

import { LoginComponent } from './views/login/login.component';
import { TasksComponent } from './views/tasks/tasks.component';
import { HashLocationStrategy, LocationStrategy } from '@angular/common';

import {UserModel} from "./model/usermodel";
import {TaskModel} from "./model/taskmodel";

import {AuthenticationService} from "./services/php/authentication.service";
import {TaskService} from "./services/php/task.service";

import {TaskGridComponent} from './views/task-grid/task-grid.component';

import { TaskFilterComponent } from './views/task-filter/task-filter.component';

import {NgbModule} from '@ng-bootstrap/ng-bootstrap';




@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    TasksComponent,
    TaskGridComponent,
    TaskFilterComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    NgxDatatableModule,
    NgbModule
  ],
  providers : [
    {provide: LocationStrategy, useClass:HashLocationStrategy}, 
    AuthenticationService,
    UserModel,
    TaskModel,
    TaskService
    ],
  bootstrap: [AppComponent]
})
export class AppModule { }
