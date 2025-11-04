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


(isApproved && (

FinalApproval

<div className="approved-info-block mt-2">

<div className="d-flex justify-content-between py-2">

<div className="premium-info-row">

<span className="label">Issued Date:</span>

<span className="value">

(cardInfo?.generatedAt ? cardInfo.generatedAt.slice(0, 10): "-")

</span>

</div>

</div>

<div className="d-flex justify-content-between py-2">

<div className="premium-info-row">

<span className="label">Status:</span>

<span </div>

className="value">{cardInfo?.cardStatus || "-"}</span>

</div>

</div>

03323

className="premium-card-visual ms-3"

style={{

flex: "320px",

minHeight: 200,

display: "flex",

justifyContent: "center",

alignItems: "center",

(isApproved && (

<div className="credit-card-ui">

<div className="bank-logo">

<img src="/Asset/Logos/try_scb_logo.png" alt="Standard Chartered" />

</div>

<div className="chip" />

<div className="cc-number">