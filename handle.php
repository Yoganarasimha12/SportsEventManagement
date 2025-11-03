// 🟢 Modified handleConfirm
const handleConfirm = async () => {
  try {
    // backend call to mark application as approved
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/approve`);

    // update UI
    setIsApproved(true);
    setShowPopup(false);
    alert("Final approval confirmed. Card process initiated.");
  } catch (error) {
    console.error("Error approving application:", error);
    alert("Failed to approve. Check console for details.");
  }
};

controller 

@PutMapping("/{applicationId}/approve")
public ResponseEntity<?> approveApplication(@PathVariable String applicationId) {
    Optional<Application> appOpt = applicationRepo.findById(applicationId);
    if (appOpt.isPresent()) {
        Application app = appOpt.get();
        app.setApplicationStatus("Approved"); // ✅ update correct column
        applicationRepo.save(app);
        return ResponseEntity.ok("Application approved successfully");
    }
    return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Application not found");
}

reject 
const handleReject = async () => {
  if (!window.confirm("Are you sure you want to reject this application?")) return;

  try {
    // backend call to mark application as rejected
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/reject`);

    // update UI
    setIsApproved(false);
    setShowPopup(false);
    alert("Application has been rejected successfully.");
  } catch (error) {
    console.error("Error rejecting application:", error);
    alert("Failed to reject. Check console for details.");
  }
};


reject controller 


@PutMapping("/{applicationId}/reject")
public ResponseEntity<String> rejectApplication(@PathVariable String applicationId) {
    Optional<Application> optionalApp = applicationRepo.findById(applicationId);
    if (optionalApp.isPresent()) {
        Application app = optionalApp.get();
        app.setApplicationStatus("Rejected");
        applicationRepo.save(app);
        return ResponseEntity.ok("Application rejected successfully");
    } else {
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Application not found");
    }
}


// Approve
const handleConfirm = async () => {
  try {
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/approve`);
    setIsApproved(true);
    setIsRejected(false);
    setShowPopup(false);
    alert("Final approval confirmed. Card process initiated.");
  } catch (error) {
    console.error("Error approving application:", error);
    alert("Failed to approve. Check console for details.");
  }
};

// Reject
const handleReject = async () => {
  if (!window.confirm("Are you sure you want to reject this application?")) return;

  try {
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/reject`);
    setIsRejected(true);
    setIsApproved(false);
    alert("Application has been rejected successfully.");
  } catch (error) {
    console.error("Error rejecting application:", error);
    alert("Failed to reject. Check console for details.");
  }
};


// --- state variables ---
const [isApproved, setIsApproved] = useState(false);
const [isRejected, setIsRejected] = useState(false);


if (res.data?.application?.applicationStatus === "Approved") {
  setIsApproved(true);
} else if (res.data?.application?.applicationStatus === "Rejected") {
  setIsRejected(true);
}

generate 

@PutMapping("/{applicationId}/approve")
public ResponseEntity<String> approveApplication(@PathVariable String applicationId) {
    Optional<Application> optionalApp = applicationRepo.findById(applicationId);
    if (optionalApp.isEmpty()) {
        return ResponseEntity.notFound().build();
    }

    Application app = optionalApp.get();
    app.setApplicationStatus("Approved");
    applicationRepo.save(app);

    // 🟢 Generate credit card details automatically
    CreditCard card = new CreditCard();
    card.setApplication(app);
    card.setCardType(app.getCardType());
    card.setCardNumber(generateCardNumber());
    card.setCvv(generateCVV());
    card.setExpiryDate(LocalDate.now().plusYears(5)); // valid for 5 years
    card.setCardStatus("Pending");
    card.setDeliveryStatus("Not Printed");
    card.setGeneratedAt(LocalDateTime.now());

    creditCardRepo.save(card);

    return ResponseEntity.ok("Application approved and credit card generated successfully");
}

// --- helper methods for generating details ---
private String generateCardNumber() {
    Random random = new Random();
    StringBuilder sb = new StringBuilder();
    for (int i = 0; i < 16; i++) {
        sb.append(random.nextInt(10));
    }
    return sb.toString();
}

private String generateCVV() {
    Random random = new Random();
    int cvv = 100 + random.nextInt(900); // 3-digit
    return String.valueOf(cvv);
}

updated handle confirm

@PutMapping("/{applicationId}/approve")
public ResponseEntity<?> approveApplication(@PathVariable String applicationId) {
    Optional<Application> optionalApp = applicationRepo.findById(applicationId);
    if (optionalApp.isEmpty()) {
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Application not found");
    }

    Application app = optionalApp.get();

    // ✅ Check if already approved
    if ("Approved".equalsIgnoreCase(app.getApplicationStatus())) {
        return ResponseEntity.ok("Application already approved. Credit card exists.");
    }

    // 1️⃣ Update application status
    app.setApplicationStatus("Approved");
    applicationRepo.save(app);

    // 2️⃣ Generate credit card details (link to this application)
    CreditCardDetails card = new CreditCardDetails();
    card.setApplication(app);
    card.setCard_type(app.getCardType()); // get from Application table
    card.setCardNumber(generateCardNumber());
    card.setCvv(generateCVV());
    card.setExpiryDate(LocalDate.now().plusYears(5)); // valid for 5 years
    card.setGeneratedAt(LocalDateTime.now());
    card.setCardStatus("Active"); // ✅ as you requested
    card.setDeliveryStatus("Not Dispatched");

    creditCardRepo.save(card);

    // 3️⃣ Return the generated card as response
    return ResponseEntity.ok(card);
}

// --- helper methods ---

private String generateCardNumber() {
    Random random = new Random();
    StringBuilder sb = new StringBuilder();
    for (int i = 0; i < 16; i++) {
        sb.append(random.nextInt(10));
    }
    return sb.toString();
}

private String generateCVV() {
    Random random = new Random();
    int cvv = 100 + random.nextInt(900); // 3-digit
    return String.valueOf(cvv);
}


updated handle confirm

const handleConfirm = async () => {
  try {
    const res = await axios.put(`http://localhost:8080/api/applications/${applicationId}/approve`);

    // set generated card details from backend
    setCardInfo(res.data);

    // update UI state
    setIsApproved(true);
    setShowPopup(false);
    alert("Final approval confirmed. Credit card generated successfully.");
  } catch (error) {
    console.error("Error approving application:", error);
    alert("Failed to approve. Check console for details.");
  }
};

