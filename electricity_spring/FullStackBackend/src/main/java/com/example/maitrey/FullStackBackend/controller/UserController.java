package com.example.maitrey.FullStackBackend.controller;
 
import java.util.HashMap;
import java.util.Map;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
 

 

 class Bill {
	 
	public int bill;
}
 @Entity
class Ans{
	 @Id
	double ans;
	Ans(double a){
		 System.out.println(a);
		ans = a;
	}
}
@RestController
public class UserController {

	 
	
	@PostMapping("/getBill")
	 ResponseEntity<Object>  newUser(@RequestBody Bill unit) { 
		double bill;
		 int units = unit.bill;
		 System.out.println(units);
	      if (units <= 50) {
	        bill = units * 3.5;
	      } else if (units <= 150) {
	        bill = 50 * 3.5 + (units - 50) * 4.00;
	      } else if (units <= 250) {
	        bill = 50 * 3.5 + 100 * 4.00 + (units - 150) * 5.20;
	      } else {
	        bill = 50 * 3.5 + 100 * 4.00 + 100 * 5.20 + (units - 250) * 6.50;
	      }
	     
	     Map<String, Double> data = new HashMap<>();
	        data.put("data", bill);
	       
	        return new ResponseEntity<>(data, HttpStatus.OK);
	}
	
	
	
	
}
