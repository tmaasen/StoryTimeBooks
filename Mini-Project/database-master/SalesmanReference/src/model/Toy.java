package model;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.NamedQuery;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;
import javax.persistence.TemporalType;

/**
 * The persistent class for the Toy database table.
 * 
 */
@Entity
@Table(name = "Toy")
@NamedQuery(name = "Toy.findAll", query = "SELECT t FROM Toy t")
public class Toy implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	@Column(name = "ToyID")
	private int toyID;

	@Temporal(TemporalType.TIMESTAMP)
	@Column(name = "InspectionTime")
	private Date inspectionTime;

	@Column(name = "Inspector")
	private String inspector;

	@Column(name = "ToyCode")
	private int toyCode;

	// bi-directional many-to-one association to Circuit
	@OneToMany(mappedBy = "toy", cascade = CascadeType.ALL)
	private List<Circuit> circuits = new ArrayList<>();

	public Toy() {
	}

	public int getToyID() {
		return this.toyID;
	}

	public Date getInspectionTime() {
		return this.inspectionTime;
	}

	public void setInspectionTime(Date inspectionTime) {
		this.inspectionTime = inspectionTime;
	}

	public String getInspector() {
		return this.inspector;
	}

	public void setInspector(String inspector) {
		this.inspector = inspector;
	}

	public int getToyCode() {
		return this.toyCode;
	}

	public void setToyCode(int toyCode) {
		this.toyCode = toyCode;
	}

	public List<Circuit> getCircuits() {
		return this.circuits;
	}

	public void setCircuits(List<Circuit> circuits) {
		this.circuits = circuits;
	}

	public Circuit addCircuit(Circuit circuit) {
		getCircuits().add(circuit);
		circuit.setToy(this);

		return circuit;
	}

	public Circuit removeCircuit(Circuit circuit) {
		getCircuits().remove(circuit);
		circuit.setToy(null);

		return circuit;
	}

}