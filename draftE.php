import React, { useState, useEffect } from "react";
import { Modal, Button, Form } from "react-bootstrap";

const DraftEmailModal = ({ show, handleClose, emailModalData }) => {
  const [subject, setSubject] = useState("");
  const [body, setBody] = useState("");

  useEffect(() => {
    if (!emailModalData) return;

    const { creditStatus, customerName, cardType } = emailModalData;

    if (creditStatus === "Approved") {
      setSubject(`🎉 Congratulations! Your ${cardType || ""} Credit Card Has Been Approved`);

      setBody(
        `Dear ${customerName || "Customer"},\n\n` +
          `We are delighted to inform you that your application for the ${cardType || "Standard"} Credit Card has been successfully approved.\n\n` +
          `Your new card will be dispatched shortly. Thank you for choosing Standard Chartered Bank.\n\n` +
          `Warm regards,\nCredit Card Origination Team`
      );
    } else if (creditStatus === "Rejected") {
      setSubject(`Update on Your ${cardType || ""} Credit Card Application`);

      setBody(
        `Dear ${customerName || "Customer"},\n\n` +
          `We appreciate your interest in the ${cardType || "Standard"} Credit Card.\n` +
          `After careful evaluation, we regret to inform you that your application could not be approved at this time.\n\n` +
          `Please feel free to reapply in the future or contact our customer support for further assistance.\n\n` +
          `Best regards,\nCredit Card Origination Team`
      );
    }
  }, [emailModalData]);

  const handleSend = () => {
    console.log("Email sent:", { subject, body });
    handleClose();
  };

  return (
    <Modal show={show} onHide={handleClose} centered size="lg">
      <Modal.Header closeButton>
        <Modal.Title>📧 Draft Email</Modal.Title>
      </Modal.Header>

      <Modal.Body>
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
        <Button variant="success" onClick={handleSend}>
          Send
        </Button>
        <Button variant="secondary" onClick={handleClose}>
          Cancel
        </Button>
      </Modal.Footer>
    </Modal>
  );
};

export default DraftEmailModal;



final app declare


import DraftEmailModal from "./DraftEmailModal";
import { useState } from "react";

const [showEmailModal, setShowEmailModal] = useState(false);

const handleOpenEmailModal = () => setShowEmailModal(true);
const handleCloseEmailModal = () => setShowEmailModal(false);


email button


<div className="action-btn-container mt-4">
  <button className="premium-btn email-btn" onClick={handleOpenEmailModal}>
    Draft Email
  </button>
</div>

<DraftEmailModal
  show={showEmailModal}
  handleClose={handleCloseEmailModal}
  emailModalData={{
    creditStatus: application?.applicationStatus, // e.g., "Approved" or "Rejected"
    customerName: application?.customer?.firstName + " " + (application?.customer?.lastName || ""),
    cardType: application?.cardType,
  }}
/>


updated draft

import React, { useState, useEffect } from "react";
import { Modal, Button, Form, Alert } from "react-bootstrap";
import axios from "axios";

const DraftEmailModal = ({ show, handleClose, emailModalData, applicationId, onPrintInitiated }) => {
  const [subject, setSubject] = useState("");
  const [body, setBody] = useState("");
  const [noteVisible, setNoteVisible] = useState(true); // show the orange note

  // Load template based on credit status
  useEffect(() => {
    if (emailModalData?.creditStatus === "Approved") {
      setSubject("Your Credit Card Approval & Print Process Initiation");
      setBody(
        `Dear ${emailModalData?.customerName || "Customer"},\n\n` +
        `We’re excited to inform you that your credit card application has been approved. ` +
        `By confirming this email, your card details will be securely forwarded to our print department for production.\n\n` +
        `Best regards,\nCredit Card Services Team`
      );
    } else if (emailModalData?.creditStatus === "Rejected") {
      setSubject("Credit Card Application Update");
      setBody(
        `Dear ${emailModalData?.customerName || "Customer"},\n\n` +
        `We regret to inform you that your credit card application was not approved at this time.\n\n` +
        `Best regards,\nCredit Card Services Team`
      );
    }
  }, [emailModalData]);

  // ✅ Trigger backend update when clicking "Send"
  const handleSend = async () => {
    try {
      await axios.put(
        `http://localhost:8080/api/creditcards/${applicationId}/update-delivery-status`,
        null,
        { params: { status: "Print Initiated" } }
      );

      alert("Print process initiated successfully!");
      onPrintInitiated?.("Print Initiated"); // optional callback to parent (FinalApproval)

      // Hide the note after successful action
      setNoteVisible(false);
      handleClose();
    } catch (error) {
      console.error("Error updating delivery status:", error);
      alert(error.response?.data || "Failed to update print status.");
    }
  };

  return (
    <Modal show={show} onHide={handleClose} centered size="lg">
      <Modal.Header closeButton>
        <Modal.Title>Draft Print Initiation Email</Modal.Title>
      </Modal.Header>

      <Modal.Body>
        {noteVisible && (
          <Alert variant="warning" className="py-2 px-3">
            <strong>Note:</strong> By clicking <em>Send</em>, you will initiate the card print process —
            your card details will be securely sent to the print shop for production.
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

export default DraftEmailModal;