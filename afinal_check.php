import React, { useState, useEffect } from "react";
import { Modal, Button, Form, Alert } from "react-bootstrap";
import axios from "axios";

const FinalDraftEmailModal = ({ show, handleClose, emailModalData, applicationId }) => {
  const [subject, setSubject] = useState("");
  const [body, setBody] = useState("");
  const [noteVisible, setNoteVisible] = useState(true);

  useEffect(() => {
    if (!emailModalData) return;

    const card_type = emailModalData?.card_type || "Credit Card";
    const status = emailModalData?.creditStatus;

    if (status === "Approved") {
      setSubject(`Congratulations! Your ${card_type} Request Has Been Approved`);
      setBody(
        `Dear ${emailModalData?.customerName || "Customer"},\n\n` +
          `We are pleased to inform you that your ${card_type} application has been successfully approved.\n` +
          `Thank you for choosing our services.\n\n` +
          `Best regards,\nCredit Assessment Team`
      );
    } else if (status === "Rejected") {
      setSubject(`${card_type} Application Update - Application Rejected`);
      setBody(
        `Dear ${emailModalData?.customerName || "Customer"},\n\n` +
          `We regret to inform you that your ${card_type} application was not approved at this time.\n\n` +
          `Best regards,\nCredit Assessment Team`
      );
    }

    // Hide note if already initiated
    if (emailModalData?.deliveryStatus === "Print Initiated") {
      setNoteVisible(false);
    }
  }, [emailModalData]);

  const handleSend = async () => {
    try {
      alert(`Email sent successfully to ${emailModalData?.customerName || "Customer"}`);

      if (emailModalData?.creditStatus === "Approved") {
        await axios.put(
          `http://localhost:8080/api/creditcards/${applicationId}/update-delivery-status`,
          null,
          { params: { status: "Print Initiated" } }
        );

        alert("Print process initiated successfully!");
        setNoteVisible(false);
      }

      handleClose();
    } catch (error) {
      console.error("Error while sending email or updating delivery status:", error);
      alert(error.response?.data || "Failed to update print status.");
    }
  };

  return (
    <Modal show={show} onHide={handleClose} centered size="lg">
      <Modal.Header closeButton>
        <Modal.Title>
          {emailModalData?.creditStatus === "Approved"
            ? "Draft Approval Email"
            : "Draft Rejection Email"}
        </Modal.Title>
      </Modal.Header>

      <Modal.Body>
        {emailModalData?.creditStatus === "Approved" && noteVisible && (
          <Alert variant="warning" className="py-2 px-3">
            <strong>Note:</strong> By clicking <em>Send</em>, you will initiate the print process —
            the approved card details will be securely sent to the print shop for production.
          </Alert>
        )}

        <Form>
          <Form.Group controlId="emailSubject" className="mb-3">
            <Form.Label>Subject</Form.Label>
            <Form.Control
              type="text"
              value={subject}
              onChange={(e) => setSubject(e.target.value)}
            />
          </Form.Group>

          <Form.Group controlId="emailBody" className="mb-3">
            <Form.Label>Message Body</Form.Label>
            <Form.Control
              as="textarea"
              rows={8}
              value={body}
              onChange={(e) => setBody(e.target.value)}
            />
          </Form.Group>
        </Form>
      </Modal.Body>

      <Modal.Footer>
        <Button variant="secondary" onClick={handleClose}>
          Close
        </Button>
        <Button variant="success" onClick={handleSend}>
          Send
        </Button>
      </Modal.Footer>
    </Modal>
  );
};

export default FinalDraftEmailModal;


try

// ✅ inside handleConfirm
await loadApplicationStatus();
await loadCardDetails();

setEmailModalData({
  creditStatus: "Approved",
  customerName: fullName,
  card_type: props.applicationInfo?.card_type,
  deliveryStatus: cardInfo?.deliveryStatus,
});

setIsApproved(true);
setShowPopup(false);
alert("Final approval confirmed. Credit card generated successfully.");


try

{isApproved && (
  <div className="action-btn-container mt-4">
    <button className="premium-btn email-btn" onClick={handleOpenEmailModal}>
      Draft Email
    </button>

    <FinalDraftEmailModal
      show={showEmailModal}
      handleClose={handleCloseEmailModal}
      emailModalData={emailModalData}
      applicationId={applicationId}
    />
  </div>
)}

try

{isRejected && (
  <div className="action-btn-container mt-4">
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
      }}
      applicationId={applicationId}
    />
  </div>
)}