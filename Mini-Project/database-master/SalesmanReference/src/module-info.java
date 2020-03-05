module salesmanreference {
	requires java.persistence;
	requires java.instrument;
	requires java.sql;
	requires servlet.api;

	opens model;
}