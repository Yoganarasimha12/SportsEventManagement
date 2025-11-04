<div id="progress-card" className="col-9 p-4 position-relative">

  {/* Delivery Status Section */}
  <div className="delivery-status-container mb-4">

    {/* Delivery Status Title — inside the container, on top */}
    <div className="delivery-status-title text-center mb-3">
      Delivery Status
    </div>

    {/* Horizontal Timeline */}
    <div className="delivery-status-steps d-flex justify-content-between align-items-center">
      {["Generated", "Printed", "Dispatched", "Delivered"].map((step, index) => {
        const stepNumber = index + 1;
        const isActive = stepNumber <= currentStep;

        return (
          <React.Fragment key={step}>
            <div className={`delivery-step ${isActive ? "active" : ""}`}>
              <div className="delivery-circle"></div>
              <div className="delivery-label">{step}</div>
            </div>

            {/* Connector line between steps */}
            {index < 3 && (
              <div className={`delivery-line ${isActive ? "active" : ""}`}></div>
            )}
          </React.Fragment>
        );
      })}
    </div>
  </div>
</div>