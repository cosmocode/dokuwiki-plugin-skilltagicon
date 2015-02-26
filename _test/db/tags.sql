CREATE TABLE taggings (pid, tag, tagger, PRIMARY KEY(pid, tag, tagger));
INSERT INTO taggings VALUES('start','skill>basic','auto');
INSERT INTO taggings VALUES('testpage_medium','skill>intermediate','auto');
INSERT INTO taggings VALUES('testpage_expert','skill>expert','auto');
INSERT INTO taggings VALUES('testpage_none','foo','auto');
