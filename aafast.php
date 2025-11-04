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
  const [error, setError] = useState(null);

  useEffect(() => {
    if (!emailModalData) return;

    const cardType = emailModalData.card_type || "Credit Card";
    const status = emailModalData.creditstatus;

    let newSubject = subject;
    let newBody = body;

    // Only initialize if fields are empty
    if (!subject && !body) {
      if (status === "Approved") {
        newSubject = `Congratulations! Your ${cardType} Request Has Been Approved`;
        newBody = `Dear ${emailModalData?.customerName || "Customer"},\n\nWe are pleased to inform you that your ${cardType} application has been successfully approved.\n\nThank you for choosing our services.\n\nBest regards,\nCredit Assessment Team`;
      } else if (status === "Rejected") {
        newSubject = `${cardType} Application Update - Application Rejected`;
        newBody = `Dear ${emailModalData?.customerName || "Customer"},\n\nWe regret to inform you that your ${cardType} application was not approved at this time.\n\nBest regards,\nCredit Assessment Team`;
      }
      setSubject(newSubject);
      setBody(newBody);
    }

    // Hide note if already generated
    if (emailModalData?.deliveryStatus === "Generated") {
      setNoteVisible(false);
    }
  }, [emailModalData]);

  const handleSend = async () => {
    try {
      alert(
        `Email sent successfully to ${emailModalData?.customerName || "Customer"}`
      );

      // Only update backend for approved case
      if (emailModalData?.creditstatus === "Approved") {
        const url = `http://localhost:8080/api/creditcards/${applicationId}/update-delivery-status`;

        await axios.put(url, null, {
          params: { status: "Generated" },
        });

        alert("Print process initiated successfully!");

        // Update parent/UI immediately without refresh
        if (onPrintInitiated) onPrintInitiated("Generated");

        setNoteVisible(false);
      }

      handleClose();
    } catch (error) {
      console.error("Error while sending email or updating delivery status:", error);
      setError(error.response?.data || "Failed to update print status.");
    }
  };

  return (
    <Modal show={show} onHide={handleClose} centered size="lg">
      <Modal.Header closeButton>
        <Modal.Title>
          {emailModalData?.creditstatus === "Approved"
            ? "Draft Approval Email"
            : "Draft Rejection Email"}
        </Modal.Title>
      </Modal.Header>

      <Modal.Body>
        {error && <Alert variant="danger">{error}</Alert>}

        {emailModalData?.creditstatus === "Approved" && noteVisible && (
          <Alert variant="info">
            <strong>Note:</strong> By clicking <em>Send</em>, you will initiate
            the print process — the approved card details will be securely sent
            to the print shop for production.
          </Alert>
        )}

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
      </Modal.Body>

      <Modal.Footer>
        <Button variant="secondary" onClick={handleClose}>
          Close
        </Button>
        <Button variant="primary" onClick={handleSend}>
          Send
        </Button>
      </Modal.Footer>
    </Modal>
  );
};

export default FinalDraftEmailModal;



try


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
        setCardInfo((prev) => ({
          ...prev,
          deliveryStatus: status, // this updates UI instantly
        }))
      }
    />
  </>
)}