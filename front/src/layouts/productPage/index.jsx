import Grid from "@mui/material/Grid";
import Divider from "@mui/material/Divider";
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";
import MDBox from "components/MDBox";
import MDTypography from "components/MDTypography";

function ProductsPage() {
  return (
    <DashboardLayout>
      <DashboardNavbar />

      <MDBox mt={4} px={2}>
        <MDTypography variant="h4" fontWeight="bold">
          🛒 Products Management
        </MDTypography>
        <MDTypography variant="button" color="text">
          Manage, update and create new products.
        </MDTypography>
      </MDBox>

      <MDBox p={3}>
        <Grid container spacing={3}>
          {/* Product Table / Product List */}
          <Grid item xs={12} md={12}>
            <MDBox bgColor="white" p={3} borderRadius="lg">
              <MDTypography variant="h6" fontWeight="medium">
                Products List
              </MDTypography>
              <Divider sx={{ my: 2 }} />

              <MDTypography color="text" variant="button">
                Product table will be added here...
              </MDTypography>
            </MDBox>
          </Grid>
        </Grid>
      </MDBox>

      <Footer />
    </DashboardLayout>
  );
}

export default ProductsPage;
