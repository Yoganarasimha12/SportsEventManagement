INSERT INTO credit_card_details (
    application_id,
    card_type,
    card_number,
    cvv,
    expiry_date,
    generated_at,
    card_status
) VALUES (
    'SA0003',                -- must match an existing application_id in the "application" table
    'Platinum',              -- or whatever type exists in your application table
    '1234567812345678',      -- 16-digit number
    '789',                   -- 3-digit CVV
    '2029-10-30',            -- expiry date (YYYY-MM-DD)
    NOW(),                   -- generatedAt (auto-set to current timestamp)
    'Pending'                -- default status
);



<div className="delivery-status-container mt-6">
  <p className="fw-bold text-secondary mb-3">Delivery Status</p>
  
  <div className={`delivery-step ${currentStep >= 1 ? "active" : ""}`}>
    <span className="delivery-circle" />
    <span className="delivery-label">Sent to Print</span>
  </div>
  <div className={`delivery-step ${currentStep >= 2 ? "active" : ""}`}>
    <span className="delivery-circle" />
    <span className="delivery-label">Printed</span>
  </div>
  <div className={`delivery-step ${currentStep >= 3 ? "active" : ""}`}>
    <span className="delivery-circle" />
    <span className="delivery-label">Dispatched</span>
  </div>
  <div className={`delivery-step ${currentStep >= 4 ? "active" : ""}`}>
    <span className="delivery-circle" />
    <span className="delivery-label">Delivered</span>
  </div>
</div>


delivery 

{/* Delivery Status Section */}
<div className="delivery-status-container mt-5">
  <h6 className="text-secondary mb-3 fw-bold">Delivery Status</h6>

  <div className="delivery-timeline d-flex align-items-center justify-content-between position-relative">
    {["Not Printed", "Printed", "Dispatched", "Delivered"].map((step, index) => {
      const stepNumber = index + 1;
      const isActive = stepNumber <= currentStep;

      return (
        <div
          key={step}
          className={`delivery-step text-center flex-fill ${isActive ? "active" : ""}`}
        >
          <div className="delivery-circle mx-auto" />
          <div className="delivery-label mt-2">{step}</div>
          {/* Line between circles */}
          {index < 3 && <div className="delivery-line" />}
        </div>
      );
    })}
  </div>
</div>