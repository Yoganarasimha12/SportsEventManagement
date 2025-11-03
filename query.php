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
<div className="delivery-status-container">
  <h6 className="text-secondary mb-3 fw-bold" style={{ position: "absolute", top: "-35px", right: "20px" }}>
    Delivery Status
  </h6>

  <div className="d-flex align-items-center justify-content-end w-100 position-relative">
    {["Not Printed", "Printed", "Dispatched", "Delivered"].map((step, index) => {
      const stepNumber = index + 1;
      const isActive = stepNumber <= currentStep;

      return (
        <React.Fragment key={step}>
          <div className={`delivery-step ${isActive ? "active" : ""}`}>
            <div className="delivery-circle"></div>
            <div className="delivery-label">{step}</div>
          </div>

          {/* Line between steps */}
          {index < 3 && <div className={`delivery-line ${isActive ? "active" : ""}`}></div>}
        </React.Fragment>
      );
    })}
  </div>
</div>

del.css

.delivery-status-container {
  margin-top: 2rem;
  position: relative;
}

.delivery-timeline {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
}

.delivery-step {
  position: relative;
  text-align: center;
  flex: 1;
}

.delivery-circle {
  width: 22px;
  height: 22px;
  border-radius: 50%;
  border: 2px solid #ccc;
  background-color: #fff;
  z-index: 2;
  transition: all 0.3s ease;
}

.delivery-step.active .delivery-circle {
  border-color: #28a745;
  background-color: #28a745;
}

.delivery-line {
  position: absolute;
  top: 10px;
  left: 50%;
  width: 100%;
  height: 3px;
  background-color: #ccc;
  z-index: 1;
}

.delivery-step.active ~ .delivery-line,
.delivery-step.active .delivery-line {
  background-color: #28a745;
}

.delivery-label {
  font-size: 0.9rem;
  margin-top: 0.5rem;
  color: #555;
  white-space: nowrap;
}

.delivery-step.active .delivery-label {
  font-weight: 600;
  color: #28a745;
}

