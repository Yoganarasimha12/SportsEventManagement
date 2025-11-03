package com.scb.axessspringboottraining.utils;

import java.util.Random;

public class CreditCardGenerator {

    public static String generateCardNumber() {
        Random random = new Random();
        StringBuilder cardNum = new StringBuilder();
        for (int i = 0; i < 16; i++) {
            cardNum.append(random.nextInt(10));
        }
        return cardNum.toString();
    }

    public static String generateCVV() {
        Random random = new Random();
        int cvv = 100 + random.nextInt(900); // Ensures 3-digit CVV between 100–999
        return String.valueOf(cvv);
    }
}

app controller 
package com.scb.axessspringboottraining.controller;

import com.scb.axessspringboottraining.entity.Application;
import com.scb.axessspringboottraining.entity.CreditCardDetails;
import com.scb.axessspringboottraining.repo.ApplicationRepo;
import com.scb.axessspringboottraining.repo.CreditCardDetailsRepo;
import com.scb.axessspringboottraining.utils.CreditCardGenerator;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.Optional;

@RestController
@RequestMapping("/api/creditcards")
public class CreditCardController {

    @Autowired
    private CreditCardDetailsRepo creditCardDetailsRepo;

    @Autowired
    private ApplicationRepo applicationRepo;

    // 🟢 Triggered when Approve/Confirm button is clicked in frontend
    @PutMapping("/{applicationId}/generate-card")
    public ResponseEntity<?> generateCreditCard(@PathVariable String applicationId) {
        Optional<Application> appOpt = applicationRepo.findById(applicationId);

        if (appOpt.isEmpty()) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Application not found");
        }

        Application app = appOpt.get();

        // If card already exists for this application, don’t regenerate
        Optional<CreditCardDetails> existing = creditCardDetailsRepo.findByApplicationId(applicationId);
        if (existing.isPresent()) {
            return ResponseEntity.ok("Credit card already exists for this application");
        }

        // Create new credit card entry
        CreditCardDetails card = new CreditCardDetails();
        card.setApplication(app);
        card.setCard_type(app.getCardType());
        card.setCardNumber(CreditCardGenerator.generateCardNumber()); // ✅ using util
        card.setCvv(CreditCardGenerator.generateCVV());                // ✅ using util
        card.setExpiryDate(LocalDate.now().plusYears(5));
        card.setGeneratedAt(LocalDateTime.now());
        card.setCardStatus("Active");
        card.setDeliveryStatus("Not Printed");

        creditCardDetailsRepo.save(card);

        return ResponseEntity.ok("Credit card generated successfully");
    }
}


confirm handle

const handleConfirm = async () => {
  try {
    // 1️⃣ Approve application first
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/approve`);

    // 2️⃣ Generate credit card details
    await axios.put(`http://localhost:8080/api/creditcards/${applicationId}/generate-card`);

    // 3️⃣ Update UI
    setIsApproved(true);
    setShowPopup(false);
    alert("Final approval confirmed. Credit card generated successfully!");
  } catch (error) {
    console.error("Error approving or generating card:", error);
    alert("Operation failed. Check console for details.");
  }
};