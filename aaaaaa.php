useEffect(() => {
  if (!emailModalData) return;

  const card_type = emailModalData?.card_type || "Credit Card";
  const status = emailModalData?.creditStatus;

  // Keep existing content unless we’re initializing fresh
  let newSubject = subject;
  let newBody = body;

  if (!subject && !body) {
    // Only set subject/body if they are empty
    if (status === "Approved") {
      newSubject = `Congratulations! Your ${card_type} Request Has Been Approved`;
      newBody =
        `Dear ${emailModalData?.customerName || "Customer"},\n\n` +
        `We are pleased to inform you that your ${card_type} application has been successfully approved.\n` +
        `Thank you for choosing our services.\n\n` +
        `Best regards,\nCredit Assessment Team`;
    } else if (status === "Rejected") {
      newSubject = `${card_type} Application Update - Application Rejected`;
      newBody =
        `Dear ${emailModalData?.customerName || "Customer"},\n\n` +
        `We regret to inform you that your ${card_type} application was not approved at this time.\n\n` +
        `Best regards,\nCredit Assessment Team`;
    }
  }

  setSubject(newSubject);
  setBody(newBody);

  // Hide only the note if already initiated, but keep content visible
  if (emailModalData?.deliveryStatus === "Print Initiated") {
    setNoteVisible(false);
  }
}, [emailModalData]);


send try


if (emailModalData?.creditStatus === "Approved") {
  await axios.put(
    `http://localhost:8080/api/creditcards/${applicationId}/update-delivery-status`,
    null,
    { params: { status: "Print Initiated" } }
  );

  alert("Print process initiated successfully!");

  // 🔥 Update emailModalData locally so UI knows status changed
  emailModalData.deliveryStatus = "Print Initiated";
  setNoteVisible(false);
}


optional try

//in handle send
onPrintInitiated?.("Print Initiated"); // optional callback

optional try

<FinalDraftEmailModal
  show={showEmailModal}
  handleClose={handleCloseEmailModal}
  emailModalData={emailModalData}
  applicationId={applicationId}
  onPrintInitiated={(status) =>
    setCardInfo((prev) => ({ ...prev, deliveryStatus: status }))
  }
/>