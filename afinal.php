public CreditCardDetails getApplicationById(String applicationId) {
    CreditCardDetails card = repo.findByApplicationId(applicationId)
        .orElseThrow(() -> new RuntimeException("Card not found for application: " + applicationId));

    // ✅ Mask card number before sending to frontend
    if (card.getCardNumber() != null && card.getCardNumber().length() >= 4) {
        String masked = maskCardNumber(card.getCardNumber());
        card.setCardNumber(masked); // replace with masked version
    }

    return card;
}