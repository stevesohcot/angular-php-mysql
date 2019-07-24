import { Component, OnInit } from '@angular/core';

import {TaskService} from "../../services/php/task.service";
import {TaskModel} from '../../model/taskmodel';
import {TaskCategoryVO} from '../../vo/task-category-vo';
import {TaskFilterVO} from '../../vo/task-filter-vo';

import {NgbDateStruct} from "@ng-bootstrap/ng-bootstrap";


@Component({
  selector: 'app-task-filter',
  templateUrl: './task-filter.component.html',
  styleUrls: ['./task-filter.component.css']
})
export class TaskFilterComponent implements OnInit {

	filterError: string;
	completed: string;

	taskFilter: TaskFilterVO = new TaskFilterVO();
	taskCategories : TaskCategoryVO[];

  startDate: NgbDateStruct;
  endDate: NgbDateStruct;
  scheduledStartDate: NgbDateStruct;
  scheduledEndDate: NgbDateStruct;

  constructor(private taskModel: TaskModel, private taskService: TaskService) {
  }

  ngOnInit() {
  		this.completed = "false";
  }

}
