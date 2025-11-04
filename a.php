fmodal

import React, { useState, useEffect } from "react";
import { Modal, Button, Form, Alert } from "react-bootstrap";
import axios from "axios";

const FinalDraftEmailModal = ({
  show,
  handleClose,
  emailModalData,
  applicationId,
  onPrintInitiated,
}) => {
  const [subject, setSubject] = useState("");
  const [body, setBody] = useState("");
  const [noteVisible, setNoteVisible] = useState(true);

  // Load customer email content dynamically based on status
  useEffect(() => {
    const card_type = emailModalData?.card_type || "Credit Card";

    if (emailModalData?.creditStatus === "Approved") {
      setSubject(`Congratulations! Your ${card_type} Request Has Been Approved`);
      setBody(
        `Dear ${emailModalData?.customerName || "Customer"},\n\n` +
          `We are pleased to inform you that your ${card_type} application has been successfully approved.\n` +
          `Thank you for choosing our services.\n\n` +
          `Best regards,\nCredit Assessment Team`
      );
    } else if (emailModalData?.creditStatus === "Rejected") {
      setSubject(`${card_type} Application Update - Application Rejected`);
      setBody(
        `Dear ${emailModalData?.customerName || "Customer"},\n\n` +
          `We regret to inform you that your ${card_type} application was not approved at this time.\n\n` +
          `Best regards,\nCredit Assessment Team`
      );
    }
  }, [emailModalData]);

  // Handle Send click
  const handleSend = async () => {
    try {
      alert(
        `Email sent successfully to ${emailModalData?.customerName || "Customer"}`
      );

      // If approved, trigger print initiation backend update
      if (emailModalData?.creditStatus === "Approved") {
        await axios.put(
          `http://localhost:8080/api/creditcards/${applicationId}/update-delivery-status`,
          null,
          { params: { status: "Print Initiated" } }
        );

        alert("Print process initiated successfully!");
        onPrintInitiated?.("Print Initiated");
        setNoteVisible(false);
      }

      handleClose();
    } catch (error) {
      console.error(
        "Error while sending email or updating delivery status:",
        error
      );
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
        {/* Show note only if Approved */}
        {emailModalData?.creditStatus === "Approved" && noteVisible && (
          <Alert variant="warning" className="py-2 px-3">
            <strong>Note:</strong> By clicking <em>Send</em>, you will initiate
            the print process — the approved card details will be securely sent
            to the print shop for production.
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

isapp

<div className="action-btn-container mt-4">
  <button className="premium-btn email-btn" onClick={handleOpenEmailModal}>
    Draft Email
  </button>

  <FinalDraftEmailModal
    show={showEmailModal}
    handleClose={handleCloseEmailModal}
    emailModalData={{
      creditStatus: props.applicationInfo?.applicationStatus, // "Approved" or "Rejected"
      customerName: fullName,
      card_type: props.applicationInfo?.card_type,
    }}
    applicationId={applicationId}
    onPrintInitiated={(status) =>
      setCardInfo((prev) => ({ ...prev, deliveryStatus: status }))
    }
  />
</div>


handle accept


const handleAccept = () => {
  if (props.applicationInfo?.currentStage !== "Final Approval") {
    alert("You can only accept the application at the Final Approval stage.");
    return;
  }

  // If stage is valid, show confirmation popup
  setShowPopup(true);
};



add ons

if (props.applicationInfo?.currentStage !== "Final Approval") {
    alert("You can only reject the application at the Final Approval stage.");
    return;
  }