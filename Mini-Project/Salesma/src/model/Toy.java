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
@Table(name="Toy")
@NamedQuery(name="Toy.findAll", query="SELECT t FROM Toy t")
public class Toy implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name="ToyId")
	private int toyId;

	@Temporal(TemporalType.TIMESTAMP)
	@Column(name="InspectionDateTime")
	private Date inspectionDateTime;

	@Column(name="Inspector")
	private String inspector;

	@Column(name="ToyCode")
	private int toyCode;

	//bi-directional many-to-one association to Circuit
	@OneToMany(mappedBy="toy", cascade = CascadeType.ALL)
	private List<Circuit> circuits = new ArrayList<>(); // MUST ADD RIGHT SIDE OF = SIGN

	public Toy() {
	}

	public int getToyId() {
		return this.toyId;
	}

	public void setToyId(int toyId) {
		this.toyId = toyId;
	}

	public Date getInspectionDateTime() {
		return this.inspectionDateTime;
	}

	public void setInspectionDateTime(Date inspectionDateTime) {
		this.inspectionDateTime = inspectionDateTime;
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