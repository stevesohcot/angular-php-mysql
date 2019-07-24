import { Component, OnInit } from '@angular/core';
import {AuthenticationService} from '../../services/php/authentication.service';
import {UserModel} from '../../model/usermodel';
import {Router} from "@angular/router";


import {UserVO} from "../../vo/user-vo";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

	username = 'steve';
	password = 'steve';

	usernameError = '';
	passwordError = '';
	loginError = '';


  constructor(private authenticationService: AuthenticationService,
  		private router: Router,
  		private userModel: UserModel
  	) { 
  }

  ngOnInit() {
  }

  onReset(): void {
  	this.username = '';
  	this.password = '';
  }

  onLogin(): void{
  	let errorFound : boolean = false;
  	this.loginError = '';

  	if (this.username === '') {
  		this.usernameError = 'You must enter a username';
  		errorFound = true;
  	} else {
  		this.usernameError = '';
  	}	
  	
  	if (this.password === '') {
  		this.passwordError = 'You must enter a password';
  		errorFound = true;
  	} else {
  		this.passwordError = '';
  	}	

  	if (errorFound === true) {
  		return;
  	}

  	this.authenticationService.authenticate(this.username, this.password)
  		.subscribe(
  			result => {
  				if (result.error) {
  					this.loginError = 'We could not log you in';
  					return;
  				}

  				this.userModel.user = result.resultObject as UserVO;
  				this.router.navigate(['/tasks']);
  			}, error => {
           this.loginError = 'There was an authentication service error';
  			}
  		);
  }
}
