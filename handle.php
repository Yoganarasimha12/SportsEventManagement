// 🟢 Modified handleConfirm
const handleConfirm = async () => {
  try {
    // backend call to mark application as approved
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/approve`);

    // update UI
    setIsApproved(true);
    setShowPopup(false);
    alert("Final approval confirmed. Card process initiated.");
  } catch (error) {
    console.error("Error approving application:", error);
    alert("Failed to approve. Check console for details.");
  }
};

controller 

@PutMapping("/{applicationId}/approve")
public ResponseEntity<?> approveApplication(@PathVariable String applicationId) {
    Optional<Application> appOpt = applicationRepo.findById(applicationId);
    if (appOpt.isPresent()) {
        Application app = appOpt.get();
        app.setApplicationStatus("Approved"); // ✅ update correct column
        applicationRepo.save(app);
        return ResponseEntity.ok("Application approved successfully");
    }
    return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Application not found");
}

reject 
const handleReject = async () => {
  if (!window.confirm("Are you sure you want to reject this application?")) return;

  try {
    // backend call to mark application as rejected
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/reject`);

    // update UI
    setIsApproved(false);
    setShowPopup(false);
    alert("Application has been rejected successfully.");
  } catch (error) {
    console.error("Error rejecting application:", error);
    alert("Failed to reject. Check console for details.");
  }
};


reject controller 


@PutMapping("/{applicationId}/reject")
public ResponseEntity<String> rejectApplication(@PathVariable String applicationId) {
    Optional<Application> optionalApp = applicationRepo.findById(applicationId);
    if (optionalApp.isPresent()) {
        Application app = optionalApp.get();
        app.setApplicationStatus("Rejected");
        applicationRepo.save(app);
        return ResponseEntity.ok("Application rejected successfully");
    } else {
        return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Application not found");
    }
}


// Approve
const handleConfirm = async () => {
  try {
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/approve`);
    setIsApproved(true);
    setIsRejected(false);
    setShowPopup(false);
    alert("Final approval confirmed. Card process initiated.");
  } catch (error) {
    console.error("Error approving application:", error);
    alert("Failed to approve. Check console for details.");
  }
};

// Reject
const handleReject = async () => {
  if (!window.confirm("Are you sure you want to reject this application?")) return;

  try {
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/reject`);
    setIsRejected(true);
    setIsApproved(false);
    alert("Application has been rejected successfully.");
  } catch (error) {
    console.error("Error rejecting application:", error);
    alert("Failed to reject. Check console for details.");
  }
};


// --- state variables ---
const [isApproved, setIsApproved] = useState(false);
const [isRejected, setIsRejected] = useState(false);


if (res.data?.application?.applicationStatus === "Approved") {
  setIsApproved(true);
} else if (res.data?.application?.applicationStatus === "Rejected") {
  setIsRejected(true);
}