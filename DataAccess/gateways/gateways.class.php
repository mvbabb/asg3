<?php
include("TableGateway.class.php");
class ArtistTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Artist";
    }
    public function getSelectStatement(){
        return "SELECT ArtistID, ArtistLink, Details, FirstName, LastName, Gender, Nationality, YearOfBirth, YearOfDeath FROM Artists";
    }
    public function getArtistWorks($id){
    	return "SELECT ImageFileName, Title, PaintingID FROM Paintings WHERE ArtistID = ".$id;
    }
    public function getPrimaryKeyName(){
        return "ArtistID";
    }

}
class CustomerLogonTableGateway extends TableDataGateway{
    public function getClassName(){
        return "CustomerLogon";
    }
    public function getSelectStatement(){
        return "SELECT CustomerID, DateJoined, DateLastModified, Pass, Salt, State, UserName FROM CustomerLogon";
    }
    public function getPrimaryKeyName(){
        return "CustomerID";
    }
}
class CustomersTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Customer";
    }
    public function getSelectStatement(){
        return "SELECT CustomerID, Address, City, Country, Email, FirstName, LastName, Phone, Postal, Privacy, Region  FROM Customers";
    }
    public function getPrimaryKeyName(){
        return "CustomerID";
    }
}
class ErasTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Era";
    }
    public function getSelectStatement(){
        return "SELECT EraID, EraName, EraYears FROM Eras";
    }
    public function getPrimaryKeyName(){
        return "EraID";
    }
}
class GalleriesTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Gallery";
    }
    public function getSelectStatement(){
        return "SELECT GalleryID, GalleryName, GalleryCity, GalleryCountry, GalleryNativeName, GalleryWebSite, Latitude, Longitude FROM Galleries";
    }
    public function getPrimaryKeyName(){
        return "GalleryID";
    }
    public function getSelectStatementForBrowseAll(){
    	return "SELECT GalleryID, GalleryName, GalleryCity, GalleryCountry FROM Galleries";
    }
    public function getPaintings($id){
    	return "SELECT PaintingID, ImageFileName, Title FROM Paintings WHERE GalleryID = " . $id . " ORDER BY Title";
    }
}
class GenresTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Genre";
    }
    public function getSelectStatement(){
        return "SELECT GenreID, GenreName, EraID, Link, Description FROM Genres";
    }
    public function getPrimaryKeyName(){
        return "GenreID";
    }
    public function getPaintings($id){ 
    	return "SELECT ImageFileName, Title, Paintings.PaintingID FROM Paintings INNER JOIN PaintingGenres ON Paintings.PaintingID = PaintingGenres.PaintingID INNER JOIN Genres ON Genres.GenreID = PaintingGenres.GenreID WHERE Genres.GenreID = $id ORDER BY YearOfWork";
    }
}
class OrderDetailsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "OrderDetail";
    }
    public function getSelectStatement(){
        return "SELECT OrderDetailID, OrderID, PaintingID, FramID, GlassID, MattID FROM OrderDetails";
    }
    public function getPrimaryKeyName(){
        return "OrderDetailID";
    }
}
class OrdersTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Order";
    }
    public function getSelectStatement(){
        return "SELECT CustomerID, DateStarted, OrderID, Quantity, ShipperID FROM Orders";
    }
    public function getPrimaryKeyName(){
        return "OrderID";
    }
}
class PaintingGenreTableGateway extends TableDataGateway{
     public function getClassName(){
        return "PaintingGenre";
    }
    public function getSelectStatement(){
        return "SELECT GenreID, PaintingGenreID, PaintingID FROM PaintingGenres";
    }
    public function getPrimaryKeyName(){
        return "PaintingGenreID";
    }
}
class PaintingsTableGateway extends TableDataGateway{
    public function getClassName(){
        return "Painting";
    }
    public function getSelectStatement(){
        return "SELECT AccessionNumber, ArtistID, CopyrightText, Cost, Description, Excerpt, GalleryID, GoogleDescription, GoogleLink, Height, ImageFileName, Medium, MSRP, MuseumLink, PaintingID, ShapeID, Title, Width, WikiLink, YearOfWork FROM Paintings";
    }
    public function getPrimaryKeyName(){
        return "PaintingID";
    }
    public function getGenre($id){
    	return "SELECT Genres.GenreID, GenreName FROM Genres JOIN PaintingGenres ON Genres.GenreID = PaintingGenres.GenreID JOIN Paintings ON Paintings.PaintingID = PaintingGenres.PaintingID WHERE Paintings.PaintingID = ". $id;
    }
    public function getShape($id){
    	return "SELECT Shapes.ShapeID, ShapeName FROM Shapes JOIN Paintings ON Shape.ShapeID = Paintings.ShapeID WHERE Shape.ShapeID = ". $id;
    	 
    }
    public function getGenreSqlStatement($id){
    	return "SELECT Genres.GenreID, GenreName FROM Genres JOIN PaintingGenres ON Genres.GenreID = PaintingGenres.GenreID JOIN Paintings ON Paintings.PaintingID = PaintingGenres.PaintingID WHERE Paintings.PaintingID = ". $id;
    	 
    }    public function getSubjectSqlStatement($id){
    	return "SELECT Subjects.SubjectID, SubjectName FROM Subjects JOIN PaintingSubjects ON Subjects.SubjectID = PaintingSubjects.SubjectID JOIN Paintings ON Paintings.PaintingID = PaintingSubjects.PaintingID WHERE Paintings.PaintingID = ". $id;
    	 
    }
    public function getReviewSqlStatement($id){
    	return "SELECT Comment, PaintingID, Rating, RatingID, ReviewDate FROM Reviews WHERE PaintingID = ".$id;
    }
    public function getArtistSqlStatement($id){
    	return "SELECT ArtistID, ArtistLink, Details, FirstName, LastName, Gender, Nationality, YearOfBirth, YearOfDeath FROM Artists WHERE ArtistID = ".$id;
    }
    public function getGallerySqlStatement($id){
    		return "SELECT GalleryID, GalleryName, GalleryCity, GalleryCountry, GalleryNativeName, GalleryWebSite, Latitude, Longitude FROM Galleries WHERE GalleryId = ".$id;
    }

}
class PaintingSubjectsTableGateway extends TableDataGateway{
    private $class = "";
    public function getClassName(){
        return "PaintingSubject";
    }
    public function getSelectStatement(){
        return "SELECT PaintingID, PaintingSubjectID, SubjectID FROM PaintingSubjects";
    }
    public function getPrimaryKeyName(){
        return "PaintingSubjectID";
    }
}
class ReviewsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Review";
    }
    public function getSelectStatement(){
        return "SELECT Comment, PaintingID, Rating, RatingID, ReviewDate FROM Reviews";
    }
    public function getPrimaryKeyName(){
        return "RatingID";
    }
}
class ShapesTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Shape";
    }
    public function getSelectStatement(){
        return "SELECT ShapeID, ShapeName FROM Shapes";
    }
    public function getPrimaryKeyName(){
        return "ShapeID";
    }
}
class SubjectsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Subject";
    }
    public function getSelectStatement(){
        return "SELECT SubjectID, SubjectName FROM Subjects";
    }
    public function getPrimaryKeyName(){
        return "SubjectID";
    }
    
    public function getPaintingsSelectStatement($id){
    	return "SELECT ImageFileName, Title, Paintings.PaintingID FROM Paintings INNER JOIN PaintingSubjects ON Paintings.PaintingID = PaintingSubjects.PaintingID INNER JOIN Subjects ON Subjects.SubjectID = PaintingSubjects.SubjectID WHERE Subjects.SubjectID = $id ORDER BY Title";
    	 
    }
}
class TypesFramesTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Frame";
    }
    public function getSelectStatement(){
        return "SELECT Color, FrameID, Price, Syle, Title FROM TypesFrames";
    }
    public function getPrimaryKeyName(){
        return "FrameID";
    }
}
class TypesGlassTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Glass";
    }
    public function getSelectStatement(){
        return "SELECT Description, GlassID, Price, Title FROM TypesGlass";
    }
    public function getPrimaryKeyName(){
        return "GlassID";
    }
}
class TypesMattTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Matt";
    }
    public function getSelectStatement(){
        return "SELECT ColorCode, MattID, Title FROM TypesMatt";
    }
    public function getPrimaryKeyName(){
        return "MattID";
    }
}
class TypesShippersTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Shipper";
    }
    public function getSelectStatement(){
        return "SELECT shipperAvgTime, shipperBaseFee, shipperClass, shipperDescription, shipperID, shipperName, shipperWeightFee FROM TypeShippers";
    }
    public function getPrimaryKeyName(){
        return "shipperID";
    }
}
class TypesStatusCodesTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Status";
    }
    public function getSelectStatement(){
        return "SELECT StatusID, Status FROM TypesStatusCodes";
    }
    public function getPrimaryKeyName(){
        return "StatusID";
    }
}
class VisitsTableGateway extends TableDataGateway{
     public function getClassName(){
        return "Visit";
    }
    public function getSelectStatement(){
        return "SELECT * FROM Visits";
    }
    public function getPrimaryKeyName(){
        return "VisitID";
    }
}










?>