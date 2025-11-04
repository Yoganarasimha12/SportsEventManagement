


<div className="premium-info-approval">
  {/* Card Details Header */}
  <div id="progress-card-header" className="mb-3">
    <h5>Card Details</h5>
  </div>

  {/* Conditional layout */}
  {!isApproved ? (
    <>
      {/* Default layout - before approval */}
      <div className="d-flex justify-content-start py-2">
        <div className="premium-info-row">
          <span className="label">Card Type:</span>
          <span className="value">{applicationInfo.card_type || "-"}</span>
        </div>
      </div>

      <div className="d-flex justify-content-start py-2">
        <div className="premium-info-row">
          <span className="label">Credit Limit:</span>
          <span className="value">
            {rules.creditLimit
              ? `Rs. ${rules.creditLimit.toLocaleString()}`
              : "Rs. -"}
          </span>
        </div>
      </div>

      <div className="d-flex justify-content-start py-2">
        <div className="premium-info-row">
          <span className="label">Interest Rate:</span>
          <span className="value">
            {rules.interestRate ? `${rules.interestRate}%` : "--"}
          </span>
        </div>
      </div>
    </>
  ) : (
    <>
      {/* Approved Layout */}
      <div className="approved-info-row d-flex justify-content-between py-2">
        <div>
          <span className="label">Credit Limit:</span>
          <span className="value">
            {rules.creditLimit
              ? `Rs. ${rules.creditLimit.toLocaleString()}`
              : "Rs. -"}
          </span>
        </div>

        <div>
          <span className="label">Interest Rate:</span>
          <span className="value">
            {rules.interestRate ? `${rules.interestRate}%` : "--"}
          </span>
        </div>
      </div>

      <div className="approval-status-badge mt-3 mb-2">
        <span>Approved</span>
      </div>

      {/* You can place the credit card details section below here */}
      <div className="card-details-section mt-3">
        {/* your card details component or info */}
      </div>
    </>
  )}

  {/* Action Buttons */}
  {(!isApproved && !isRejected) && (
    <div className="action-btn-container mt-4">
      {/* buttons here */}
    </div>
  )}
</div>


css


.premium-info-approval {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  padding: 20px;
}

.premium-info-row .label {
  font-weight: 600;
  color: #1a2b5f;
  margin-right: 8px;
}

.premium-info-row .value {
  color: #2d2d2d;
  font-weight: 500;
}

.approved-info-row .label {
  font-weight: 600;
  color: #1a2b5f;
  margin-right: 6px;
}

.approved-info-row .value {
  color: #212529;
  font-weight: 500;
}

.approval-status-badge {
  background: linear-gradient(90deg, #00c896, #007a5f);
  color: #fff;
  font-weight: 600;
  letter-spacing: 0.5px;
  padding: 6px 16px;
  border-radius: 12px;
  display: inline-block;
  font-size: 14px;
  box-shadow: 0 2px 6px rgba(0, 200, 150, 0.2);
  text-align: center;
}



edit

 <div className="approval-status-badge mt-3 mb-2 d-inline-flex align-items-center">
        <i className="bi bi-check-circle-fill me-2"></i>
        <span>Approved</span>
      </div>


try

.premium-info-approval {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  padding: 20px;
}

.premium-info-row .label {
  font-weight: 600;
  color: #1a2b5f;
  margin-right: 8px;
}

.premium-info-row .value {
  color: #2d2d2d;
  font-weight: 500;
}

.approved-info-row .label {
  font-weight: 600;
  color: #1a2b5f;
}

.approved-info-row .value {
  color: #212529;
  font-weight: 500;
}

.approval-status-badge {
  background: #e6fff5;
  color: #007a5f;
  font-weight: 600;
  letter-spacing: 0.5px;
  padding: 8px 16px;
  border-radius: 12px;
  display: inline-flex;
  align-items: center;
  font-size: 14px;
  border: 1px solid #00b389;
}

.approval-status-badge i {
  font-size: 1.2rem;
  color: #00b389;
}

update


{/* After Approval */}
<div className="approved-info-row py-2">
  <div className="info-pair">
    <div className="info-item">
      <span className="label">Credit Limit:</span>
      <span className="value">
        {rules.creditLimit
          ? `Rs. ${rules.creditLimit.toLocaleString()}`
          : "Rs. -"}
      </span>
    </div>

    <div className="info-item">
      <span className="label">Interest Rate:</span>
      <span className="value">
        {rules.interestRate ? `${rules.interestRate}%` : "--"}
      </span>
    </div>
  </div>
</div>

{/* ✅ Approved Badge */}
<div className="approval-status-badge mt-3 mb-2 d-inline-flex align-items-center">
  <i className="bi bi-check-circle-fill me-2"></i>
  <span>Approved</span>
</div>


<div className="premium-info-approval">

  {/* Card Details Header */}
  <div id="progress-card-header" className="mb-3">
    <h5>Card Details</h5>
  </div>

  {/* One row: Credit Limit & Interest Rate side by side */}
  <div className="premium-info-row dual">
    <div className="info-item">
      <span className="label">Credit Limit:</span>
      <span className="value">
        {rules.creditLimit
          ? `Rs. ${rules.creditLimit.toLocaleString()}`
          : "Rs. -"}
      </span>
    </div>

    <div className="info-item">
      <span className="label">Interest Rate:</span>
      <span className="value">
        {rules.interestRate ? `${rules.interestRate}%` : "--"}
      </span>
    </div>
  </div>

  {/* Approved Badge */}
  <div className="approval-status-badge mt-4">
    <i className="bi bi-check-circle-fill me-2"></i>
    <span>Approved</span>
  </div>

</div>