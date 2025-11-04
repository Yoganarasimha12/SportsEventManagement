<div className="action-btn-container mt-4">

  {/* Draft Email (only after Approved) */}
  {isApproved && (
    <>
      <button className="premium-btn email-btn" onClick={handleOpenEmailModal}>
        Draft Email
      </button>

      <FinalDraftEmailModal
        show={showEmailModal}
        handleClose={handleCloseEmailModal}
        emailModalData={emailModalData}
        applicationId={applicationId}
        onPrintInitiated={(status) =>
          setCardInfo((prev) => ({ ...prev, deliveryStatus: status }))
        }
      />
    </>
  )}

  {/* Draft Email (only after Rejected) */}
  {isRejected && (
    <>
      <button className="premium-btn email-btn" onClick={handleOpenEmailModal}>
        Draft Email
      </button>

      <FinalDraftEmailModal
        show={showEmailModal}
        handleClose={handleCloseEmailModal}
        emailModalData={{
          creditStatus: "Rejected",
          customerName: fullName,
          card_type: applicationInfo?.card_type,
          deliveryStatus: cardInfo?.deliveryStatus,
          applicationId: applicationId,
        }}
      />
    </>
  )}

  {/* Accept / Reject Buttons (only before final decision) */}
  {!isApproved && !isRejected && (
    <div className="button-group mt-3 d-inline-block">
      <button className="accept-btn me-2" onClick={handleAccept}>
        Accept
      </button>
      <button className="reject-btn" onClick={handleReject}>
        Reject
      </button>
    </div>
  )}

</div>