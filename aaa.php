const CARD_RULES = {
  Platinum: { interestRate: 20, creditLimit: 100000 },
  Sapphire: { interestRate: 18, creditLimit: 150000 },
  Emerald: { interestRate: 15, creditLimit: 200000 },
  Black: { interestRate: 12, creditLimit: 500000 },
};



<span className="value">
      {rules.creditLimit
        ? `Rs. ${rules.creditLimit.toLocaleString()}`
        : "Rs. --"}
    </span>


<span className="value">
      {rules.interestRate ? `${rules.interestRate}%` : "--"}
    </span>


ccd controller

@PutMapping("/{applicationId}/update-delivery-status")
public ResponseEntity<?> updateDeliveryStatus(
        @PathVariable String applicationId,
        @RequestParam String status) {

    Optional<CreditCardDetails> cardOpt = creditCardDetailsRepo.findByApplicationId(applicationId);
    if (cardOpt.isEmpty()) {
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Credit card not found for application ID: " + applicationId);
    }

    CreditCardDetails card = cardOpt.get();
    card.setDeliveryStatus(status);
    creditCardDetailsRepo.save(card);

    return ResponseEntity.ok("Delivery status updated to " + status);
}

handle print

const handleUpdateDeliveryStatus = async (newStatus) => {
  try {
    await axios.put(
      `http://localhost:8080/api/creditcards/${applicationId}/update-delivery-status`,
      null,
      { params: { status: newStatus } }
    );
    alert(`Card status updated to ${newStatus}`);
    setCardInfo((prev) => ({ ...prev, deliveryStatus: newStatus }));
  } catch (error) {
    console.error("Error updating delivery status:", error);
    alert("Failed to update status");
  }
};

button container 

<div className="action-btn-container mt-4">
  {cardInfo.deliveryStatus === "Not Printed" && (
    <button
      className="premium-btn print-btn"
      onClick={() => handleUpdateDeliveryStatus("Print Initiated")}
    >
      Send to Print Shop
    </button>
  )}

  {cardInfo.deliveryStatus === "Print Initiated" && (
    <button
      className="premium-btn print-btn"
      onClick={() => handleUpdateDeliveryStatus("Printed")}
    >
      Mark as Printed
    </button>
  )}

  {cardInfo.deliveryStatus === "Printed" && (
    <button
      className="premium-btn dispatch-btn"
      onClick={() => handleUpdateDeliveryStatus("Dispatched")}
    >
      Mark as Dispatched
    </button>
  )}

  {cardInfo.deliveryStatus === "Dispatched" && (
    <button
      className="premium-btn deliver-btn"
      onClick={() => handleUpdateDeliveryStatus("Delivered")}
    >
      Mark as Delivered
    </button>
  )}

  <button className="premium-btn email-btn">Draft Email</button>
</div>


ccd contro

@PutMapping("/{applicationId}/update-delivery-status")
public ResponseEntity<?> updateDeliveryStatus(
        @PathVariable String applicationId,
        @RequestParam String status) {

    Optional<CreditCardDetails> cardOpt = creditCardDetailsRepo.findByApplicationId(applicationId);
    if (cardOpt.isEmpty()) {
        return ResponseEntity.status(HttpStatus.NOT_FOUND)
                .body("Credit card not found for application ID: " + applicationId);
    }

    CreditCardDetails card = cardOpt.get();
    String currentStatus = card.getDeliveryStatus();

    // ✅ Rule 1: Only "Print Initiated" can be updated from frontend
    if (!"Print Initiated".equalsIgnoreCase(status)) {
        return ResponseEntity.status(HttpStatus.BAD_REQUEST)
                .body("Sales user can only set status to 'Print Initiated'.");
    }

    // ✅ Rule 2: Only allow from null or "Not Printed"
    if (currentStatus != null &&
        !currentStatus.equalsIgnoreCase("Not Printed") &&
        !currentStatus.trim().isEmpty()) {
        return ResponseEntity.status(HttpStatus.BAD_REQUEST)
                .body("Cannot initiate print. Current status: " + currentStatus);
    }

    // ✅ Update to Print Initiated
    card.setDeliveryStatus("Print Initiated");
    creditCardDetailsRepo.save(card);

    return ResponseEntity.ok("Delivery status updated to Print Initiated");
}

handle print

const handlePrintInitiation = async () => {
  try {
    await axios.put(
      `http://localhost:8080/api/creditcards/${applicationId}/update-delivery-status`,
      null,
      { params: { status: "Print Initiated" } }
    );

    alert("Print process initiated successfully!");
    // immediately update UI
    setCardInfo((prev) => ({ ...prev, deliveryStatus: "Print Initiated" }));
  } catch (error) {
    console.error("Error updating delivery status:", error);
    alert(error.response?.data || "Failed to update status.");
  }
};


buttons

<div className="action-btn-container mt-4">
  {(cardInfo.deliveryStatus === null ||
    cardInfo.deliveryStatus === "" ||
    cardInfo.deliveryStatus === "Not Printed") && (
      <button
        className="premium-btn print-btn"
        onClick={handlePrintInitiation}
      >
        Send to Print Shop
      </button>
    )}
  <button className="premium-btn email-btn">Draft Email</button>
</div>