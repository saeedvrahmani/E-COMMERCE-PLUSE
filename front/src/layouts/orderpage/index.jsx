import Grid from "@mui/material/Grid";
import Divider from "@mui/material/Divider";
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";
import MDBox from "components/MDBox";
import MDTypography from "components/MDTypography";

function OrdersPage() {
  return (
    <DashboardLayout>
      <DashboardNavbar />

      <MDBox mt={4} px={2}>
        <MDTypography variant="h4" fontWeight="bold">
          🧾 Order Management
        </MDTypography>
        <MDTypography variant="button" color="text">
          Manage incoming orders here.
        </MDTypography>
      </MDBox>

      <MDBox p={3}>
        <Grid container spacing={3}>
          {/* Orders Table */}
          <Grid item xs={12} md={12}>
            <MDBox bgColor="white" p={3} borderRadius="lg">
              <MDTypography variant="h6" fontWeight="medium">
                Orders List
              </MDTypography>
              <Divider sx={{ my: 2 }} />

              <MDTypography color="text" variant="button">
                Order table will appear here...
              </MDTypography>
            </MDBox>
          </Grid>
        </Grid>
      </MDBox>

      <Footer />
    </DashboardLayout>
  );
}

export default OrdersPage;
