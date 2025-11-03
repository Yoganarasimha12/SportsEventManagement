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

add ons
{/* Delivery Status Section */}
<div className="delivery-status-container flex-column">
  <h6 className="delivery-status-title text-center mb-4">Delivery Status</h6>

  <div className="d-flex align-items-center justify-content-center w-100 position-relative">
    {["Not Printed", "Printed", "Dispatched", "Delivered"].map((step, index) => {
      const stepNumber = index + 1;
      const isActive = stepNumber <= currentStep;

      return (
        <React.Fragment key={step}>
          <div className={`delivery-step ${isActive ? "active" : ""}`}>
            <div className="delivery-circle"></div>
            <div className="delivery-label">{step}</div>
          </div>
          {index < 3 && <div className={`delivery-line ${isActive ? "active" : ""}`}></div>}
        </React.Fragment>
      );
    })}
  </div>
</div>

try

<div className="delivery-status-container mt-4">
  <div className="delivery-header">
    <h6 className="delivery-title">Delivery Status</h6>
  </div>

  <div className="delivery-steps-wrapper">
    <div className={`delivery-step ${currentStep >= 1 ? "active" : ""}`}>
      <span className="delivery-circle" />
      <span className="delivery-label">Sent to Print</span>
    </div>
    <div className="delivery-line" />
    <div className={`delivery-step ${currentStep >= 2 ? "active" : ""}`}>
      <span className="delivery-circle" />
      <span className="delivery-label">Printed</span>
    </div>
    <div className="delivery-line" />
    <div className={`delivery-step ${currentStep >= 3 ? "active" : ""}`}>
      <span className="delivery-circle" />
      <span className="delivery-label">Dispatched</span>
    </div>
    <div className="delivery-line" />
    <div className={`delivery-step ${currentStep >= 4 ? "active" : ""}`}>
      <span className="delivery-circle" />
      <span className="delivery-label">Delivered</span>
    </div>
  </div>
</div>


del.css


.delivery-status-container {
  display: flex;
  flex-direction: column;  /* 👈 stack heading and steps vertically */
  background: #ffffff;
  padding: 22px 30px;
  border-radius: 12px;
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
  width: 90%;
  margin: 40px auto 0;
}

.delivery-header {
  text-align: left;
  margin-bottom: 15px;
}

.delivery-title {
  font-size: 18px;
  font-weight: 700;
  color: #1a2b5f;
}

.delivery-steps-wrapper {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.delivery-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 25%;
  position: relative;
}

.delivery-circle {
  width: 26px;
  height: 26px;
  border-radius: 50%;
  border: 3px solid #8fa6c5;
  background-color: #e5eaf0;
  transition: 0.3s ease-in-out;
}

.delivery-step.active .delivery-circle {
  background: #00497f;
  border-color: #00497f;
  box-shadow: 0 0 12px rgba(0, 200, 150, 0.6);
}

.delivery-label {
  font-size: 13px;
  font-weight: 600;
  color: #1a2b5f;
  margin-top: 8px;
  opacity: 0.55;
  transition: 0.3s;
}

.delivery-step.active .delivery-label {
  opacity: 1;
  color: #00704a;
}

.delivery-line {
  flex-grow: 1;
  height: 3px;
  background: #c6d3e6;
  margin: 0 6px;
  transition: 0.3s ease-in-out;
  margin-top: 13px; /* 👈 Adjust this to move the line up/down */
}

.delivery-step.active + .delivery-line {
  background: #00a97f;
}
