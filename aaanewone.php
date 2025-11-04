{isApproved && (
    <>
      <div className="d-flex justify-content-between py-2">
        <div className="premium-info-row">
          <span className="label">Issued Date:</span>
          <span className="value">
            {cardInfo?.generatedAt ? cardInfo.generatedAt.slice(0, 10) : "-"}
          </span>
        </div>
      </div>

      <div className="d-flex justify-content-between py-2">
        <div className="premium-info-row">
          <span className="label">Status:</span>
          <span className="value">{cardInfo?.cardStatus || "-"}</span>
        </div>
      </div>
    </>
  )}
</div>



{/* Show Issued Date and Status ONLY when approved */}
{isApproved && (
  <div className="approved-info-block mt-2">
    <div className="d-flex justify-content-between py-2">
      <div className="premium-info-row">
        <span className="label">Issued Date:</span>
        <span className="value">
          {cardInfo?.generatedAt ? cardInfo.generatedAt.slice(0, 10) : "-"}
        </span>
      </div>
    </div>

    <div className="d-flex justify-content-between py-2">
      <div className="premium-info-row">
        <span className="label">Status:</span>
        <span className="value">{cardInfo?.cardStatus || "-"}</span>
      </div>
    </div>
  </div>
)}