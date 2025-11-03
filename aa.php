service

@Service
public class CreditCardDetailsService {

    @Autowired
    private CreditCardDetailsRepo repo;

    @Autowired
    private ApplicationRepository applicationRepository; // Make sure you have this repo

    private String maskCardNumber(String cardNumber) {
        if (cardNumber.length() >= 4) {
            return "XXXX-XXXX-XXXX-" + cardNumber.substring(cardNumber.length() - 4);
        }
        return cardNumber;
    }

    public CreditCardDetails getApplicationById(String applicationId) {
        return repo.findByApplicationId(applicationId)
                .orElseThrow(() -> new RuntimeException("Card not found for application: " + applicationId));
    }

    // ✅ NEW METHOD
    public CreditCardDetails createCardForApplication(String applicationId, CreditCardDetails cardDetails) {
        // Find existing application
        Application app = applicationRepository.findById(applicationId)
                .orElseThrow(() -> new RuntimeException("Application not found: " + applicationId));

        // Attach app to card
        cardDetails.setApplication(app);

        // Default status
        if (cardDetails.getCardStatus() == null) {
            cardDetails.setCardStatus("Pending");
        }

        // Set generatedAt if null
        if (cardDetails.getGeneratedAt() == null) {
            cardDetails.setGeneratedAt(LocalDateTime.now());
        }

        // Mask card number for safety
        if (cardDetails.getCardNumber() != null) {
            cardDetails.setCardNumber(maskCardNumber(cardDetails.getCardNumber()));
        }

        return repo.save(cardDetails);
    }
}

controller 

@RestController
@RequestMapping("/api/creditcards")
@CrossOrigin(origins = "http://localhost:3000")
public class CreditCardDetailsController {

    @Autowired
    private CreditCardDetailsService service;

    @GetMapping("/{applicationId}")
    public ResponseEntity<CreditCardDetails> getCardByApplicationId(@PathVariable String applicationId) {
        CreditCardDetails card = service.getApplicationById(applicationId);
        return ResponseEntity.ok(card);
    }

    // ✅ NEW ENDPOINT
    @PostMapping("/{applicationId}")
    public ResponseEntity<CreditCardDetails> createCardForApplication(
            @PathVariable String applicationId,
            @RequestBody CreditCardDetails cardDetails) {

        CreditCardDetails savedCard = service.createCardForApplication(applicationId, cardDetails);
        return ResponseEntity.status(HttpStatus.CREATED).body(savedCard);
    }
}