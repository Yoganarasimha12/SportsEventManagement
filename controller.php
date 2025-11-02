package com.scb.axessspringboottraining.controller;

import com.scb.axessspringboottraining.models.CreditCardDetails;
import com.scb.axessspringboottraining.service.CreditCardDetailsService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/creditcards")
@CrossOrigin(origins = "http://localhost:3000")
public class CreditCardDetailsController {

    @Autowired
    private CreditCardDetailsService service;

    // ✅ The main issue was the incorrect parentheses and misplaced method
    @GetMapping("/{applicationId}")
    public ResponseEntity<CreditCardDetails> getCardByApplicationId(@PathVariable String applicationId) {
        CreditCardDetails card = service.getApplicationById(applicationId);
        return ResponseEntity.ok(card);
    }
}